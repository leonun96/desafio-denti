import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css';
import { createBrowserRouter, createRoutesFromElements, Route, RouterProvider} from "react-router-dom"
import Root from './routes/root';
import ErrorPage from './components/ErrorPage';
import { IngresosComponent } from './components/IngresosComponent';
import EgresosComponent from './components/EgresosComponent';
import Dashboard from './components/Dashboard';

// import Contact from "./contacts";

// const router = createBrowserRouter(
//   createRoutesFromElements(
//     <Route>
//       <Route index element={<Root/>}></Route>
//     </Route>
//   )
// )

const router = createBrowserRouter([
  {
    path: "/",
    element: <Root />,
    errorElement: <ErrorPage />,
    children: [
      {
        index: <Dashboard/>,
        element: <Dashboard />,
      },
      {
        path: "ingresos/",
        element: <IngresosComponent />,
      },
      {
        path: "egresos/",
        element: <EgresosComponent />,
      },
    ]
  },
]);

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
  <React.StrictMode>
    <RouterProvider router={router} />
  </React.StrictMode>
);

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
// reportWebVitals();
