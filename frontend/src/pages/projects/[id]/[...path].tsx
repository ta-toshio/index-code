import React from 'react'
import { NextPage } from 'next'
import { useRouter } from 'next/router'
import TreeMenu, { ItemComponent } from 'react-simple-tree-menu'
import Layout from '../../../components/Layout'
import useFilePath from '../../../features/projects/useFilePath'
import Code from '../../../features/code/Code'
import useCodeByFilePath from '../../../features/code/useCodeByFilePath'

const DEFAULT_PADDING = 0.75
const ICON_SIZE = 2
const LEVEL_SPACE = 0.75

const File: NextPage = () => {
  const router = useRouter()
  const { path } = router.query
  const filePath = typeof path !== 'string' && path && path.join('/')

  const { tree } = useFilePath({ projectId: router.query.id })
  const { file } = useCodeByFilePath({ projectId: router.query.id, filePath })
  console.log(file)

  return (
    <Layout>
      <div className="explore">
        <div className="explore__sidebar">
          <TreeMenu
            data={tree}
            hasSearch={false}
            onClickItem={({ hasNodes, level, key }) => {
              if (!hasNodes) {
                if (level === 0) {
                  router.push(`/projects/${router.query.id}/${key}`)
                  return
                }

                const pathPart = key
                  .split('/')
                  .slice(-1 * level - 1)
                  .join('/')
                router.push(`/projects/${router.query.id}/${pathPart}`)
              }
            }}
          >
            {({ items }) => (
              <ul className="tree-item-group">
                {items.map(({ key, ...props }) => (
                  <ItemComponent
                    key={key}
                    {...props}
                    style={{
                      ...props.style,
                      paddingLeft: `${
                        DEFAULT_PADDING +
                        ICON_SIZE * (props.hasNodes ? 0 : 1) +
                        props.level * LEVEL_SPACE
                      }rem`,
                    }}
                  />
                ))}
              </ul>
            )}
          </TreeMenu>
        </div>
        {/*  /explore__sidebar  */}
        <div className="explore__content">
          <Code file={file} />
        </div>
      </div>
    </Layout>
  )
}

export default File
