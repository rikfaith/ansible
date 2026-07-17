#!/bin/bash

export HF_TOKEN=$(cat ~/.hf-token)
export LMCACHE_USE_EXPERIMENTAL=True
export LMCACHE_LOCAL_DISK="file://$HOST/vllm_cache"

python -m vllm.entrypoints.openai.api_server \
  --model QuantTrio/Qwen3-Coder-30B-A3B-Instruct-AWQ \
  --quantization awq \
  --dtype float16 \
  --gpu-memory-utilization 0.95 \
  --max-model-len 64k \
  --safetensors-load-strategy=prefetch \
  --enable-auto-tool-choice \
  --tool-call-parser qwen3_coder \
  --enable-prefix-caching \
  --kv-cache-dtype fp8 \
  --max-num-seqs 2
