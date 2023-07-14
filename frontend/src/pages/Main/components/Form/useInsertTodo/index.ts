import * as React from 'react'
import { FormProps } from '..'

export const useInsertTodo = (params: FormProps) => {
  const [value, setValue] = React.useState<string>()
  const [error, setError] = React.useState<boolean>()

  const handleSubmitForm = React.useCallback(
    async (value: string) => {
      try {
        setError(false)

        if (value.length < 5) {
          setError(true)
          return
        }

        await params.onSubmit({
          name: value
        })
        await params.onUpdate()
      } catch {
        setError(true)
      }
    },
    [params]
  )

  return {
    value,
    setValue,
    error,
    setError,
    handleSubmitForm
  }
}
