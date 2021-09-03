import { useEffect, useRef, useState } from 'react'
import Editor from 'react-markdown-editor-lite'

const useMyEditor = () => {
  const editor = useRef<Editor>(null)
  const [editing, setEditing] = useState(true)

  useEffect(() => {
    if (editing) {
      editor.current &&
        editor.current.setView({ menu: false, html: false, md: true })
    } else {
      editor.current &&
        editor.current.setView({ menu: false, html: true, md: false })
    }
  }, [editing])

  return {
    editor,
    editing,
    setEditing,
  }
}

export default useMyEditor
