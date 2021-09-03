import React from 'react'
import { NextPage } from 'next'
import Layout from '../../components/Layout'
import MyEditor from '../../features/note/MyEditor'

const NewNote: NextPage = () => {
  return (
    <Layout>
      <div className="note">
        <MyEditor />
      </div>
    </Layout>
  )
}

export default NewNote
