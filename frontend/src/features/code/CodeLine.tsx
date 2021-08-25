import React, { useState } from 'react'
import SyntaxHighlighter from 'react-syntax-highlighter'
import { getLanguage } from '../../utils/highlight'
import { File } from '../../generated/graphql'

type Props = {
  line: string
  file: File
  index: number
  setNodes: any
}

const CodeLine: React.FC<Props> = ({ line, file, index, setNodes }) => {
  const [isHover, setIsHover] = useState<boolean>(false)
  return (
    <>
      <td className="line">{index}</td>
      <td
        style={{ position: 'relative' }}
        className="code annotated"
        onMouseEnter={() => setIsHover(true)}
        onMouseLeave={() => setIsHover(false)}
      >
        {isHover && (
          <button
            onClick={() =>
              setNodes((prev) => {
                prev.push({
                  id: null,
                  key: prev.length ? prev[prev.length - 1].key + 1 : 0,
                  text: '',
                })
                return [...prev]
              })
            }
            style={{
              float: 'left',
              position: 'absolute',
              left: 0,
              lineHeight: '0.999rem',
            }}
          >
            +
          </button>
        )}
        <SyntaxHighlighter language={getLanguage(file.extension)}>
          {line}
        </SyntaxHighlighter>
      </td>
    </>
  )
}

export default CodeLine
