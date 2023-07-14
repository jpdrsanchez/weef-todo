import {
  Box,
  IconButton,
  List as MUIList,
  ListItem,
  ListItemButton,
  ListItemIcon,
  ListItemText,
  ListSubheader,
  OutlinedInput
} from '@mui/material'
import { AiFillDelete, AiFillEdit, AiOutlineSave } from 'react-icons/ai'
import { BsCheck2 } from 'react-icons/bs'
import { DtoTodo, TodoStatus } from '../../../../services/weef/v1/todos/dtoTodo'
import { DtoUpdateTodoRequest } from '../../../../services/weef/v1/todos/dtoUpdateTodoRequest'
import { DtoDeleteTodoInterface } from '../../../../services/weef/v1/todos/dtoDeleteTodoRequest'
import { useEditTodo } from './useEditTodo'

interface ListProps {
  todos?: DtoTodo[]
  loading?: boolean
  error?: boolean
  onClick: (params: DtoUpdateTodoRequest) => Promise<void>
  onUpdate: () => Promise<void>
  onDelete: (params: DtoDeleteTodoInterface) => Promise<void>
}

export const List = (props: ListProps) => {
  const update = useEditTodo({
    onUpdate: async (params: DtoUpdateTodoRequest) => {
      await props.onClick(params)
      await props.onUpdate()
    }
  })
  return (
    <MUIList
      subheader={
        <ListSubheader
          component="div"
          sx={{ bgcolor: '#fafafa;', color: '#111' }}
        >
          Todo List
        </ListSubheader>
      }
    >
      {props.loading && (
        <ListItem>
          <ListItemText primary="Carregando" />
        </ListItem>
      )}
      {!props.loading && !props.todos?.length && (
        <ListItem>
          <ListItemText primary="Nenhum item adicionado" />
        </ListItem>
      )}
      {!props.loading &&
        !!props.todos?.length &&
        props.todos.map(todo => (
          <ListItem
            key={todo.id}
            secondaryAction={
              <Box sx={{ display: 'flex', gap: 2, alignItems: 'center' }}>
                <IconButton
                  edge="end"
                  onClick={async event => {
                    event.preventDefault()

                    if (todo.id === update.isEditing) {
                      await update.handleFinishEditing({
                        id: todo.id,
                        name: update.value
                      })
                      update.setIsEditing(undefined)
                      update.setValue(undefined)
                    } else {
                      update.setIsEditing(todo.id)
                      update.setValue(todo.title)
                    }
                  }}
                >
                  {update.isEditing ? <AiOutlineSave /> : <AiFillEdit />}
                </IconButton>
                <IconButton
                  edge="end"
                  onClick={async event => {
                    event.preventDefault()
                    await props.onDelete({ id: todo.id })
                    await props.onUpdate()
                  }}
                >
                  <AiFillDelete />
                </IconButton>
              </Box>
            }
          >
            <ListItemIcon>
              <IconButton
                onClick={async event => {
                  event.preventDefault()
                  await props.onClick({
                    id: todo.id,
                    status:
                      todo.status === TodoStatus.DONE
                        ? TodoStatus.UNDONE
                        : TodoStatus.DONE
                  })
                  await props.onUpdate()
                }}
                sx={{
                  color: '#fff',
                  width: 32,
                  height: 32,
                  borderRadius: 32,
                  borderWidth: 1,
                  borderColor:
                    todo.status === TodoStatus.DONE ? '#74c69d' : '#222',
                  borderStyle: 'solid',
                  display: 'flex',
                  fontSize: 24,
                  alignItems: 'center',
                  justifyContent: 'center',
                  background:
                    todo.status === TodoStatus.DONE ? '#74c69d' : 'none'
                }}
              >
                {todo.status === TodoStatus.DONE ? <BsCheck2 /> : null}
              </IconButton>
            </ListItemIcon>
            {update.isEditing === todo.id ? (
              <OutlinedInput
                type="text"
                value={update.value}
                onChange={event => {
                  update.setValue(event.target.value)
                }}
              />
            ) : (
              <ListItemText primary={todo.title} />
            )}
          </ListItem>
        ))}
    </MUIList>
  )
}
