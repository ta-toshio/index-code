import { NextPage } from 'next'
import Layout from '../../../components/Layout'
import { useRouter } from 'next/router'
import useFilePath from '../../../features/projects/useFilePath'
import React from 'react'
import TreeMenu, { ItemComponent } from 'react-simple-tree-menu'

const DEFAULT_PADDING = 0.75
const ICON_SIZE = 2
const LEVEL_SPACE = 0.75

const File: NextPage = () => {
  const router = useRouter()
  const { tree } = useFilePath({ projectId: router.query.id })
  // console.log(router.query)
  // console.log(data)
  return (
    <Layout>
      <div className="explore">
        <div className="explore__sidebar">
          <TreeMenu data={tree} hasSearch={false}>
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
        <div></div>
      </div>
    </Layout>
  )
}

export default File
