import * as React from 'react'
import { DtoUpdateTodoRequest } from '../../../../../services/weef/v1/todos/dtoUpdateTodoRequest'

interface UseEditTodoParams {
  onUpdate: (params: DtoUpdateTodoRequest) => Promise<void>
}

export const useEditTodo = (params: UseEditTodoParams) => {
  const [isEditing, setIsEditing] = React.useState<number>()
  const [value, setValue] = React.useState<string>()

  const handleFinishEditing = React.useCallback(
    async (request: DtoUpdateTodoRequest) => {
      await params.onUpdate(request)
    },
    [params]
  )

  return {
    isEditing,
    setIsEditing,
    value,
    setValue,
    handleFinishEditing
  }
}
