import axios from 'axios';

const API_URL = 'http://localhost:3000/api';

export async function fetchData() {
  try {
    const response = await axios.get(`${API_URL}/data`);
    return response.data;
  } catch (error) {
    console.error(error);
    return [];
  }
}
