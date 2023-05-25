import { useTranslation } from 'react-i18next';
import './App.css';
import { useEffect, useState } from 'react';
import axios from 'axios';
import Welcome from './components/Welcome';
import Home from './components/Home';
import LoadingBars from './components/utility/LoadingBars';

const API_URL = 'https://webtelligence.pt/api/my-qrcode/index.php'

function App() {
  const { t } = useTranslation();

  const [user, setUser] = useState(null)
  const [loading, setLoading] = useState(true)

  useEffect(() => {
    const getUser = () => {
      axios.get(API_URL, {
        params: {
          action: 'get_user'
        }
      })
      .then((response) => {
        console.log(response)
        setLoading(false)
        setUser(response.data);
      })
      .catch((error) => {
        console.error('Error verifying user logged in state:', error)
      })
    }

    getUser();
  }, [])

  return (
    loading ? (<LoadingBars classes={'m-5'} />) : (user ? (<Home />) : (<Welcome />))
  );
}

export default App;
