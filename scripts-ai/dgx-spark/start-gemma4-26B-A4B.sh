#!/bin/bash
# -*-ksh-*-
MODEL=google/gemma-4-26B-A4B-it
NAME=gemma

export VLLM_CONTAINER=$(docker ps --format '{{.Names}}' | grep -E '^node-[0-9]+$')
echo "Found container: $VLLM_CONTAINER"
docker exec -it $VLLM_CONTAINER /bin/bash -c '
  vllm serve \
    $MODEL \
    --served-model-name $NAME \
\
    --max-model-len 16384 \
    --gpu-memory-utilization 0.8 \
\
    --tensor-parallel-size 2 \
    --distributed-executor-backend ray \
    --host 0.0.0.0 \
    --port 8888'
