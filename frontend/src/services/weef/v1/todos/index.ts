import { wpapi } from '../../../instances'
import { DtoCreateTodoRequest } from './dtoCreateTodoRequest'
import { DtoDeleteTodoInterface } from './dtoDeleteTodoRequest'
import { DtoGetAllTodosResponse } from './dtoGetAllTodosResponse'
import { DtoTodo } from './dtoTodo'
import { DtoUpdateTodoRequest } from './dtoUpdateTodoRequest'

export class TodoService {
  public static async getAll() {
    const response = await wpapi.get<DtoGetAllTodosResponse>('weef/v1/todos')

    return response.data
  }

  public static async create(request: DtoCreateTodoRequest) {
    const response = await wpapi.post<DtoTodo>('weef/v1/todos', request)

    return response.data
  }

  public static async update(request: DtoUpdateTodoRequest) {
    const response = await wpapi.put<DtoTodo>('weef/v1/todos', request)

    return response.data
  }

  public static async delete(request: DtoDeleteTodoInterface) {
    await wpapi.delete('weef/v1/todos', { data: request })
  }
}
