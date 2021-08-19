export const makeTree = (allFilePath, filePath, depth: number) => {
  if (!filePath.is_dir) {
    return {
      key: filePath.file_path,
      label: filePath.name,
    }
  }

  const childNodes = allFilePath.filter(
    (_filePath) => _filePath.parent_id == filePath.id
  )
  if (!childNodes.length) {
    return {
      key: filePath.file_path,
      label: filePath.name,
    }
  }

  return {
    key: filePath.file_path,
    label: filePath.name,
    nodes: childNodes.map((_filePath) =>
      makeTree(allFilePath, _filePath, depth + 1)
    ),
  }
}
