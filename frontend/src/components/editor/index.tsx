import React, { forwardRef } from 'react'
import dynamic from 'next/dynamic'
import Editor from 'react-markdown-editor-lite'

// const MdEditor = dynamic(() => import('react-markdown-editor-lite'), {
//   ssr: false,
// })
const MdEditor = dynamic(() => import('./WrappedEditor'), {
  ssr: false,
})

const ForwardRefEditor = forwardRef<Editor>((props, ref) => (
  <MdEditor {...props} editorRef={ref} />
)) as any // @TODO replace any

export const onImageUpload = (file) => {
  return new Promise((resolve) => {
    const reader = new FileReader()
    reader.onload = (data) => {
      resolve(data.target.result)
    }
    reader.readAsDataURL(file)
  })
}

export default ForwardRefEditor
