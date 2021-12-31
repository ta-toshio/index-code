import React from 'react'
import ReactMarkdown from 'react-markdown'
import ForwardRefEditor, { onImageUpload } from '../../components/editor'
import useMyEditor from './useMyEditor'
import CodeInMarkupCode from '../code/CodeInMarkupCode'

const MyEditor: React.FC = () => {
  const { editor, setEditing } = useMyEditor()

  return (
    <>
      <div className="field">
        <input
          type="checkbox"
          id="preview"
          name="preview"
          className="switch"
          onChange={(e) => {
            setEditing(!e.target.checked)
          }}
        />
        <label htmlFor="preview">Preview</label>
      </div>
      <ForwardRefEditor
        ref={editor}
        autoFocus={true}
        view={{ menu: false, html: false }}
        onImageUpload={onImageUpload}
        renderHTML={(text: string) => (
          <ReactMarkdown
            components={{
              code({ inline, className, children, ...props }) {
                const match = /language-(\w+)-\((.*)\)-\[(.*)\]/.exec(
                  className || ''
                )

                // ```ic-(EC-CUBE/ec-cube)-[src/Eccube/Doctrine/ORM/Mapping/Driver/AnnotationDriver.php]```
                if (!inline && match && match[1] === 'ic') {
                  const projectName = match[2]
                  const filePath = match[3].split('#')[0] ?? null
                  const lineNum = match[0].split('#')
                  const startLine = lineNum[1] ?? undefined
                  const endLine = lineNum[2] ?? undefined

                  return (
                    <CodeInMarkupCode
                      projectName={projectName}
                      filePath={filePath}
                      startLine={startLine ? parseInt(startLine) : undefined}
                      endLine={endLine ? parseInt(endLine) : undefined}
                    >
                      {children}
                    </CodeInMarkupCode>
                  )
                }
                return (
                  <code className={className} {...props}>
                    {children}
                  </code>
                )
              },
            }}
          >
            {text}
          </ReactMarkdown>
        )}
      />
    </>
  )
}

export default MyEditor
