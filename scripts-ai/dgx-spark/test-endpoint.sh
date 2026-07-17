#!/bin/bash
# test-endpoint.sh -*-ksh-*-

curl http://localhost:8888/v1/completions \
  -H "Content-Type: application/json" \
  -d '{
    "prompt": "Write a haiku about a GPU",
    "max_tokens": 1024,
    "temperature": 0.7
  }'  | jq
