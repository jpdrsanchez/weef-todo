import {
  Box,
  FormControl,
  IconButton,
  InputAdornment,
  InputLabel,
  OutlinedInput
} from '@mui/material'
import { AiOutlineSend } from 'react-icons/ai'
import { DtoCreateTodoRequest } from '../../../../services/weef/v1/todos/dtoCreateTodoRequest'
import { useInsertTodo } from './useInsertTodo'

export interface FormProps {
  onSubmit: (params: DtoCreateTodoRequest) => Promise<void>
  onUpdate: () => Promise<void>
}

export const Form = (props: FormProps) => {
  const insert = useInsertTodo(props)

  return (
    <Box
      component="form"
      sx={{ width: '100%', mb: 3 }}
      onSubmit={async event => {
        event.preventDefault()
        await insert.handleSubmitForm(insert.value ?? '')
      }}
    >
      <FormControl variant="outlined" sx={{ width: '100%' }}>
        <InputLabel htmlFor="create">Novo Item</InputLabel>
        <OutlinedInput
          name="create"
          id="create"
          type="text"
          endAdornment={
            <InputAdornment position="end">
              <IconButton aria-label="Enviar" edge="end" type="submit">
                <AiOutlineSend />
              </IconButton>
            </InputAdornment>
          }
          label="Novo Item"
          value={insert.value}
          onChange={event => {
            insert.setValue(event.target.value)
          }}
          error={!!insert.error}
        />
      </FormControl>
    </Box>
  )
}
