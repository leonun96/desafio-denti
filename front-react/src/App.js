import logo from './logo.svg';
import './App.css';

import {
  BrowserRouter, Routes, Route,createBrowserRouter,RouterProvider,
} from "react-router-dom";
// PROPIOS
import Root from './routes/root';
import ErrorPage from './components/ErrorPage';
import { IngresosComponent } from './components/IngresosComponent';
import { Dashboard } from './components/Dashboard';
import EgresosComponent from './components/EgresosComponent';


function App() {
  return (
    <div className="App">
      <BrowserRouter>
        <Routes>
          <Route path='/' element={ <Dashboard/> } />
          <Route path='/ingresos' element={ <IngresosComponent/> } />
          <Route path='/egresos' element={ <EgresosComponent/> } />
        </Routes>
      </BrowserRouter>      
    </div>
  );
}

export default App;
