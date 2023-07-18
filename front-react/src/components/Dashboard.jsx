import React, {useEffect, useState} from 'react'
import axios from 'axios'


const endpoint = "http://localhost/api/dashboard";
export default function Dashboard() {
  const [ ingresos, setIngresos ] = useState( '' )
  const [ egresos, setEgresos ] = useState( '' )
  const [ balance, setBalance ] = useState( '' )
  const headers = {
    'Content-Type': 'application/json',
    'Access-Control-Allow-Origin': 'Access-Control-Allow-Origin',
  }
  const getData = async () => {
    const response = await axios.get(`${endpoint}`, {
      headers: headers
    })
    console.log(ingresos,egresos,balance);
    setIngresos(response.data.ingresos)
    setEgresos(response.data.egresos)
    setBalance(response.data.ingresos - response.data.egresos)
  }
  useEffect ( ()=>{
    getData();
  }, [])
  return (
    <div>
      <div className="container-fluid">

    <div className="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 className="h3 mb-0 text-gray-800">Inicio</h1>
    </div>
    <div className="row">


      <div className="col-xl-4 col-md-6 mb-4">
        <div className="card border-left-primary shadow h-100 py-2">
          <div className="card-body">
            <div className="row no-gutters align-items-center">
              <div className="col mr-2">
                <div className="text-xs font-weight-bold text-primary text-uppercase mb-1">
                  Ingresos (Del Mes)</div>
                <div className="h5 mb-0 font-weight-bold text-gray-800">${ingresos}</div>
              </div>
              <div className="col-auto">
                <i className="fas fa-solid fa-sack-dollar fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div className="col-xl-4 col-md-6 mb-4">
        <div className="card border-left-success shadow h-100 py-2">
          <div className="card-body">
            <div className="row no-gutters align-items-center">
              <div className="col mr-2">
                <div className="text-xs font-weight-bold text-success text-uppercase mb-1">
                  Egresos (Del Mes)</div>
                <div className="h5 mb-0 font-weight-bold text-gray-800">${egresos}</div>
              </div>
              <div className="col-auto">
                <i className="fas fa-dollar-sign fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div className="col-xl-4 col-md-6 mb-4">
        <div className="card border-left-warning shadow h-100 py-2">
          <div className="card-body">
            <div className="row no-gutters align-items-center">
              <div className="col mr-2">
                <div className="text-xs font-weight-bold text-success text-uppercase mb-1">
                  Balance Mensual</div>
                <div className="h5 mb-0 font-weight-bold text-gray-800">${balance}</div>
              </div>
              <div className="col-auto">
                <i className="fas fa-clipboard-list fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    </div>
  )
}
