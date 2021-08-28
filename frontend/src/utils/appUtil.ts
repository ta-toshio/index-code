export const getLinkFromSearchPath = (searchPath: string) => {
  const split = searchPath.split(':')
  const project = split.shift()
  const path = split.join('')
  return `/${encodeURIComponent(project)}/${path}`
}
