import React from 'react'
import SyntaxHighlighter from 'react-syntax-highlighter'
import { getLanguage } from '../../utils/highlight'
import useCodeByFilePath from './useCodeByFilePath'
import CodeLine from './CodeLine'
import CodeLineWrapper from './CodeLineWrapper'

type Props = {
  projectId: number | undefined
  filePath: string | undefined
}

const Code: React.FC<Props> = ({ projectId, filePath }) => {
  const { file } = useCodeByFilePath({ projectId, filePath })

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
                file.body
                  .split('\n')
                  .map((line, index) => (
                    <CodeLineWrapper
                      key={`tr-${index + 1}`}
                      line={line}
                      file={file}
                      index={index + 1}
                    />
                  ))}
            </tbody>
          </table>
        </code>
      </div>
    </div>
  )
}

export default Code
