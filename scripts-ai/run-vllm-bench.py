#!/usr/bin/python3
import itertools
import json
import subprocess
from pathlib import Path
import pandas as pd

# 1. Define your sweep matrix
IOSL_LIST = [
  (200, 200),
  (1000, 1000),
  (500, 2000),
  (5000, 500),
  (6000, 100),
  (16000, 100),
]
CONCURRENCIES = [1, 2, 50, 100, 150, 200]
NUM_PROMPTS_MULTIPLIER = 4  # Ensure total requests > max_concurrency

RESULTS_DIR = Path("./vllm-bench-results")
RESULTS_DIR.mkdir(exist_ok=True)

model_name = "gemma"
base_url = "http://10.42.93.170:8000"

results_summary = []

# 2. Grid Sweep Execution
for (isl, osl), concurrency in itertools.product(IOSL_LIST, CONCURRENCIES):
    print(f"Running: ISL={isl} | OSL={osl} | Concurrency={concurrency}")

    num_prompts = max(concurrency * NUM_PROMPTS_MULTIPLIER, 1000)
    json_output_path = RESULTS_DIR / f"bench_isl{isl}_osl{osl}_c{concurrency}.json"

    cmd = [
        "vllm-bench",
        "--backend", "openai",
        "--base-url", base_url,
        "--model", model_name,
        "--dataset-name", "random",
        "--input-len", str(isl),
        "--output-len", str(osl),
        "--max-concurrency", str(concurrency),
        "--num-prompts", str(num_prompts),
        "--save-result",
        "--result-filename", str(json_output_path)
    ]

    subprocess.run(cmd, check=True)

    # 3. Parse JSON output
    if json_output_path.exists():
        with open(json_output_path, "r") as f:
            data = json.load(f)
            results_summary.append({
                "ISL": isl,
                "OSL": osl,
                "Concurrency": concurrency,
                "Request_Throughput_req_s": data.get("request_throughput", 0),
                "Output_Throughput_tok_s": data.get("output_throughput", 0),
                "Mean_TTFT_ms": data.get("mean_ttft_ms", 0),
                "Mean_TPOT_ms": data.get("mean_tpot_ms", 0),
                "P95_E2E_Latency_s": data.get("p95_e2e_latency_s", 0)
            })

# Save parsed metrics to CSV for easy analysis
df = pd.DataFrame(results_summary)
df.to_csv(RESULTS_DIR / "summary_results.csv", index=False)
print("Benchmarking complete. Data saved to bench_results/summary_results.csv")
