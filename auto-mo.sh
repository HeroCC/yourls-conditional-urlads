#!/bin/bash

# 指定目录
directory="languages"
# 切换到目标目录
cd "$directory" || exit 1

# 获取目录下的所有.po文件
po_files=$(find . -name "*.po" 2>/dev/null)
# 循环处理每个.po文件
for po_file in $po_files; do
  # 提取文件名（不包含扩展名）
  base_name=$(basename "$po_file" .po)
  # 构造.mo文件名
  mo_file="${base_name}.mo"
  # 使用msgfmt命令将.po文件转换成.mo文件
  msgfmt "$po_file" -o "$mo_file"
  # 检查转换是否成功
  if [ $? -eq 0 ]; then
    echo "[自动转换] $po_file --> $mo_file"
  else
    echo "[自动转换] $po_file -x> $mo_file"
  fi
done
