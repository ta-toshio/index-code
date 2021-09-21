import React from 'react'
import useCodeByFilePathLine from './useCodeByFilePathLine'
import { lineBreak } from 'acorn'

type Props = {
  projectName: string | undefined
  filePath: string | undefined
  startLine?: number | null | undefined
  endLine?: number | null | undefined
}

const CodeInMarkupCode: React.FC<Props> = (props) => {
  const { lines } = useCodeByFilePathLine(props)
  return <code>{lines && lines.map((line) => `${line}\n`)}</code>
}

export default CodeInMarkupCode
