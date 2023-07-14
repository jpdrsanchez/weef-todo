import '@fontsource/roboto/300.css'
import '@fontsource/roboto/400.css'
import '@fontsource/roboto/500.css'
import '@fontsource/roboto/700.css'
import * as React from 'react'
import { Main } from './pages/Main'
import { CssBaseline } from '@mui/material'

const App = () => {
  return (
    <React.Fragment>
      <CssBaseline />
      <Main />
    </React.Fragment>
  )
}

export default App
