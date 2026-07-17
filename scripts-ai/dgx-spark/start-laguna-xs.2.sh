#!/bin/bash -x
# -*-ksh-*-

cd ~/vllm-coding
source .venv/bin/activate

#vllm serve \
#  poolside/Laguna-XS.2 \
#  --served-model-name laguna \
#  --tool-call-parser poolside_v1 \
#  --reasoning-parser poolside_v1 \
#  --enable-auto-tool-choice \
#  --default-chat-template-kwargs '{"enable_thinking": true}' \
#\
#  --max-model-len auto \
#  --gpu-memory-utilization 0.8 \
#\
#  --tensor-parallel-size 2 \
#  --distributed-executor-backend ray \
#  --host 0.0.0.0 \
#  --port 8888

export VLLM_CONTAINER=$(docker ps --format '{{.Names}}' | grep -E '^node-[0-9]+$')
echo "Found container: $VLLM_CONTAINER"
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
    --port 8888"
