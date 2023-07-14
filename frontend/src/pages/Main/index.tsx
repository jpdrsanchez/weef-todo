import { Box } from '@mui/material'
import { Form } from './components/Form'
import { useTodoService } from './useTodoService'
import { List } from './components/List'

export const Main = () => {
  const todos = useTodoService()
  return (
    <Box
      component="main"
      sx={{
        width: '100%',
        height: '100vh',
        padding: 4,
        overflow: 'auto',
        display: 'flex'
      }}
    >
      <Box
        component="div"
        sx={{
          width: '100%',
          maxWidth: 400,
          margin: 'auto'
        }}
      >
        <Form
          onSubmit={todos.handleCreateTodo}
          onUpdate={todos.handleGetTodos}
        />
        <Box
          component="nav"
          sx={{
            width: '100%',
            boxShadow: 'rgba(99, 99, 99, 0.2) 0px 2px 8px 0px',
            bgcolor: '#fafafa;'
          }}
        >
          <List
            todos={todos.todos}
            loading={todos.loading}
            error={todos.error}
            onUpdate={todos.handleGetTodos}
            onClick={todos.handleUpdateTodo}
            onDelete={todos.handleDeleteTodo}
          />
        </Box>
      </Box>
    </Box>
  )
}
