import axios from "axios"

const base_url = 'http://localhost:8000/api'

export default {
    async get(url) {
        const response = await axios.get(`${base_url}/${url}`)
        return response
    },
    async post(url, values) {
        const response = await axios.post(`${base_url}/${url}`, values)
        return response
    }
}
