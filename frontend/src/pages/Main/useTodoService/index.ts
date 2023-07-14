import * as React from 'react'
import { DtoTodo } from '../../../services/weef/v1/todos/dtoTodo'
import { TodoService } from '../../../services/weef/v1/todos'
import { DtoUpdateTodoRequest } from '../../../services/weef/v1/todos/dtoUpdateTodoRequest'
import { DtoDeleteTodoInterface } from '../../../services/weef/v1/todos/dtoDeleteTodoRequest'
import { DtoCreateTodoRequest } from '../../../services/weef/v1/todos/dtoCreateTodoRequest'

export const useTodoService = () => {
  const [todos, setTodos] = React.useState<DtoTodo[]>()
  const [loading, setLoading] = React.useState<boolean>()
  const [error, setError] = React.useState<boolean>()

  const handleGetTodos = React.useCallback(async () => {
    try {
      setError(false)
      setLoading(true)
      const response = await TodoService.getAll()
      setTodos(response.todos)
      console.log(response.todos)
    } catch {
      setError(true)
    } finally {
      setLoading(false)
    }
  }, [])

  const handleUpdateTodo = React.useCallback(
    async (params: DtoUpdateTodoRequest) => {
      try {
        setError(false)
        setLoading(true)
        await TodoService.update(params)
      } catch {
        setError(true)
      } finally {
        setLoading(false)
      }
    },
    []
  )

  const handleDeleteTodo = React.useCallback(
    async (params: DtoDeleteTodoInterface) => {
      try {
        setError(false)
        setLoading(true)
        await TodoService.delete(params)
      } catch {
        setError(true)
      } finally {
        setLoading(false)
      }
    },
    []
  )

  const handleCreateTodo = React.useCallback(
    async (params: DtoCreateTodoRequest) => {
      try {
        setError(false)
        setLoading(true)
        await TodoService.create(params)
      } catch {
        setError(true)
      } finally {
        setLoading(false)
      }
    },
    []
  )

  React.useEffect(() => {
    handleGetTodos()
  }, [handleGetTodos])

  return {
    todos,
    loading,
    error,
    handleGetTodos,
    handleUpdateTodo,
    handleDeleteTodo,
    handleCreateTodo
  }
}
