import axios from 'axios'

export const wpapi = axios.create({
  baseURL: 'http://localhost:8080/api'
})
