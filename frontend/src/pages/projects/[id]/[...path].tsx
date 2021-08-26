import React from 'react'
import { NextPage } from 'next'
import { useRouter } from 'next/router'
import Layout from '../../../components/Layout'
import Code from '../../../features/code/Code'
import Explore from '../../../features/code/Explore'

const File: NextPage = () => {
  const router = useRouter()
  const { path } = router.query
  const filePath = typeof path !== 'string' && path && path.join('/')
  const projectId = router.query.id && +router.query.id

  return (
    <Layout>
      <div className="project">
        <div className="project__sidebar">
          <Explore projectId={projectId} />
        </div>
        {/*  /explore__sidebar  */}
        <div className="project__content">
          <Code projectId={projectId} filePath={filePath} />
        </div>
      </div>
    </Layout>
  )
}

export default File
