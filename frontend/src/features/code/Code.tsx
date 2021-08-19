import React from 'react'
import SyntaxHighlighter from 'react-syntax-highlighter'
import { File } from '../../generated/graphql'
import { getLanguage } from '../../utils/highlight'

type Props = {
  file: File | undefined
}

const Code: React.FC<Props> = ({ file }) => {
  return (
    <div>
      {/*{file && file.body && (*/}
      {/*  <SyntaxHighlighter*/}
      {/*    showLineNumbers={true}*/}
      {/*    language={getLanguage(file.extension)}*/}
      {/*  >*/}
      {/*    {file.body}*/}
      {/*  </SyntaxHighlighter>*/}
      {/*)}*/}
      <div className="blob blob-page__blob test-repo-blob">
        <code className="blob__code test-blob">
          <table>
            <tbody>
              {file &&
                file.body &&
                file.body.split('\n').map((line, index) => (
                  <tr key={`tr-${index + 1}`}>
                    <td className="line" data-line={index + 1}>
                      {index + 1}
                    </td>
                    <td className="code annotated">
                      <SyntaxHighlighter language={getLanguage(file.extension)}>
                        {line}
                      </SyntaxHighlighter>
                    </td>
                  </tr>
                ))}
            </tbody>
          </table>
        </code>
      </div>
    </div>
  )
}

export default Code
