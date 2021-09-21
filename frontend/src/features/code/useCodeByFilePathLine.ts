import useCodeByFilePath from './useCodeByFilePath'
import { useEffect, useState } from 'react'

type Props = {
  projectName: string | undefined
  filePath: string | undefined
  startLine?: number | null | undefined
  endLine?: number | null | undefined
}

const getCode = (
  body: string,
  start: number | undefined,
  end: number | undefined
) => {
  const startNum = start ?? 1
  const endNum = end ?? Infinity

  return body.split('\n').filter((line, i) => {
    const lineNum = i + 1
    return startNum <= lineNum && lineNum <= endNum
  })
}

const useCodeByFilePathLine = ({
  projectName,
  filePath,
  startLine,
  endLine,
}: Props) => {
  const [lines, setLines] = useState<string[]>()

  const { called, loading, file } = useCodeByFilePath({ projectName, filePath })

  useEffect(() => {
    if (file && file.body) {
      const tmpLines = getCode(file.body, startLine, endLine)
      setLines(tmpLines)
    }
  }, [file, startLine, endLine])

  return {
    lines,
    called,
    loading,
  }
}

export default useCodeByFilePathLine
