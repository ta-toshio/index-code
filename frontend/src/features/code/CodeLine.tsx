import React, { useState } from 'react'
import SyntaxHighlighter from 'react-syntax-highlighter'
import { getLanguage } from '../../utils/highlight'
import { File } from '../../generated/graphql'

type Props = {
  line: string
  file: File
  index: number
  addMemoForm: () => void
}

const CodeLine: React.FC<Props> = ({ line, file, index, addMemoForm }) => {
  const [isHover, setIsHover] = useState<boolean>(false)
  return (
    <tr className="code-line">
      <td className="line">{index}</td>
      <td
        style={{ position: 'relative' }}
        className="code annotated"
        onMouseEnter={() => setIsHover(true)}
        onMouseLeave={() => setIsHover(false)}
      >
        {isHover && (
          <button className="code-line__add-memo-btn" onClick={addMemoForm}>
            +
          </button>
        )}
        <SyntaxHighlighter language={getLanguage(file.extension)}>
          {line}
        </SyntaxHighlighter>
      </td>
    </tr>
  )
}

export default CodeLine
