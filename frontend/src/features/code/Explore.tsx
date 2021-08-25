import React from 'react'
import { useRouter } from 'next/router'
import TreeMenu, { ItemComponent } from 'react-simple-tree-menu'
import useFilePath from '../projects/useFilePath'

const DEFAULT_PADDING = 0.75
const ICON_SIZE = 2
const LEVEL_SPACE = 0.75

type Props = {
  projectId: number | undefined
}

const Explore: React.FC<Props> = ({ projectId }) => {
  const router = useRouter()

  const { tree } = useFilePath({ projectId })

  return (
    <TreeMenu
      data={tree}
      hasSearch={false}
      onClickItem={({ hasNodes, level, key }) => {
        if (!hasNodes) {
          if (level === 0) {
            router.push(`/projects/${projectId}/${key}`)
            return
          }

          const pathPart = key
            .split('/')
            .slice(-1 * level - 1)
            .join('/')
          router.push(`/projects/${projectId}/${pathPart}`)
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
  )
}

export default Explore
