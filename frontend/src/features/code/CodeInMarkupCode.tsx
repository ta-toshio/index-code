import React from 'react'
import useCodeByFilePathLine from './useCodeByFilePathLine'

type Props = {
  projectName: string | undefined
  filePath: string | undefined
  startLine?: number | undefined
  endLine?: number | undefined
}

const CodeInMarkupCode: React.FC<Props> = (props) => {
  const { lines } = useCodeByFilePathLine(props)
  if (!lines) return <></>
  return <code>{lines && lines.map((line) => `${line}\n`)}</code>
}

export default CodeInMarkupCode
