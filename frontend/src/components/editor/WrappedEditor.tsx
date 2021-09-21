import Editor, { Plugins } from 'react-markdown-editor-lite'
import React from 'react'

const WrappedEditor = ({ editorRef, ...props }) => {
  Editor.use(Plugins.TabInsert, {
    tabMapValue: 1,
  })
  // @ts-ignore
  return <Editor {...props} ref={editorRef} />
}
export default WrappedEditor
