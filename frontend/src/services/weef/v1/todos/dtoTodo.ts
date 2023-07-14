export enum TodoStatus {
  DONE = "done",
  UNDONE = "undone",
}

export interface DtoTodo {
  id: number;
  name: string;
  title: string;
  status: TodoStatus;
}
