import Editor from 'react-markdown-editor-lite'
import React from 'react'

const WrappedEditor = ({ editorRef, ...props }) => {
  // @ts-ignore
  return <Editor {...props} ref={editorRef} />
}
export default WrappedEditor
