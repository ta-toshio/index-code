import React from 'react'
import ReactMarkdown from 'react-markdown'
import ForwardRefEditor, { onImageUpload } from '../../components/editor'
import useMyEditor from './useMyEditor'

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
        onImageUpload={onImageUpload}
        view={{ menu: false, html: false }}
        renderHTML={(text) => <ReactMarkdown>{text}</ReactMarkdown>}
        autoFocus={true}
      />
    </>
  )
}

export default MyEditor
