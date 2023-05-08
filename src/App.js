import React, { useState, useEffect } from 'react';
import { fetchData } from './data';

function App() {
  const [data, setData] = useState([]);

  useEffect(() => {
    const getData = async () => {
      const data = await fetchData();
      setData(data);
    };
    getData();
  }, []);

  return (
    <div>
      <h1>Data</h1>
      <ul>
        {data.map(item => (
          <li key={item.id}>{item.name}</li>
        ))}
      </ul>
    </div>
  );
}

export default App;

