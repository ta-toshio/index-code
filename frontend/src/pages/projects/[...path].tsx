import React, { useMemo } from 'react'
import { NextPage } from 'next'
import { useRouter } from 'next/router'
import Layout from '../../components/Layout'
import Code from '../../features/code/Code'
import Explore from '../../features/code/Explore'

const File: NextPage = () => {
  const router = useRouter()
  const { path } = router.query
  // const filePath = typeof path !== 'string' && path && path.join('/')
  const filePath = useMemo(() => {
    if (!path) {
      return
    }
    return `${(path as string[]).slice(1).join('/')}`
  }, [path])
  const projectName = path && path[0]
  console.log(filePath)

  return (
    <Layout>
      <div className="project">
        <div className="project__sidebar">
          <Explore projectName={projectName} />
        </div>
        {/*  /explore__sidebar  */}
        <div className="project__content">
          <Code projectName={projectName} filePath={filePath} />
        </div>
      </div>
    </Layout>
  )
}

export default File
