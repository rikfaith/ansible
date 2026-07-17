#!/bin/bash
#export VLLM_IMAGE=vllm/vllm-openai:v0.25.1-cu129
#docker pull $VLLM_IMAGE
#export VLLM_CONTAINER=$(docker ps --format '{{.Names}}' | grep -E '^node-[0-9]+$')
#echo "Found container: $VLLM_CONTAINER"

export HF_TOKEN=$(cat ~/.hf-token)
export LMCACHE_USE_EXPERIMENTAL=True
export LMCACHE_LOCAL_DISK="file://$HOST/vllm_cache"

docker exec -it $VLLM_CONTAINER /bin/bash -c "
  vllm serve \
    poolside/Laguna-XS-2.1 \
    --served-model-name laguna \
    --tool-call-parser poolside_v1 \
    --reasoning-parser poolside_v1 \
    --enable-auto-tool-choice \
    --default-chat-template-kwargs '{\"enable_thinking\": true}' \
\
    --max-model-len 16384 \
    --gpu-memory-utilization 0.8 \
    --enforce-eager \
\
    --tensor-parallel-size 2 \
    --distributed-executor-backend ray \
    --host 0.0.0.0 \
    --port 8000"

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
