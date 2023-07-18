import React, {useEffect, useState} from 'react'
import {Link} from 'react-router-dom'

const endpoint = "http://localhost/api/egreso";

export default function EgresosComponent() {

  const date = new Date();
  const [ fecha, setFecha ] = useState( formatDate(date,'yy-mm-dd') )
  const [ monto, setMonto ] = useState( '' )
  function formatDate(date, format) {
      const map = {
          mm: `0${date.getMonth() + 1}`,
          dd: date.getDate(),
          yy: date.getFullYear(),
          yyyy: date.getFullYear()
      }
  
      return format.replace(/mm|dd|yy|yyyy/gi, matched => map[matched])
  }

  useEffect ( ()=>{
      getAllEgresos();
  }, [])

  const [ egresos, setEgresos ] = useState( [] )

  const getAllEgresos = async () => {
    await fetch(`${endpoint}`, { method: 'GET' })
    .then(response => {
        return response.json()
    })
    .then(data => {
      setEgresos(data)
      console.log(data, egresos, Object.keys(egresos));
    });
  }
  const deleteEgresos = async (id) => {
    await fetch(`${endpoint}/${id}/delete`, { method: 'DELETE' })
    .then(response => {
        return response.json()
    })
    .then(data => {
        console.log(data);
        // setIngresos(data)
    });
    getAllEgresos();
  }

  const storeEgreso = async (e) => {
    e.preventDefault()
    console.log("ENVIANDO...", `${endpoint}/store`)
    await fetch(`${endpoint}/store`,
        {
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
            },
            method: 'POST',
            body : JSON.stringify({
                fecha: fecha,
                monto: monto, 
            })
        },
    ).then(response => {
        return response.json()
    })
    .then(data => {
        console.log(data);
    });
    getAllEgresos();
}

  return (
    <div>
        <div className='d-grid gap-2'>
          <button type="button" className="btn btn-success btn-lg mt-2 mb-2 text-white" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Egreso
          </button>
        </div>

        <table className='table table-striped'>
            <thead className='bg-primary text-white'>
                <tr>
                    <th>Monto</th>
                    <th>Fecha</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                {
                    (egresos).map( (egreso, index) => (
                        <tr key={index}>
                            <td> {egreso.monto} </td>
                            <td> {egreso.fecha} </td>
                            <td>
                                {/* <Link to={`/edit/${product.id}`} className='btn btn-warning'>Edit</Link> */}
                                <button onClick={ ()=>deleteEgresos(egreso.id) } className='btn btn-danger'>Eliminar</button>
                            </td>
                        </tr>
                    ) )
                }
            </tbody>
        </table>
        <div className="modal fade" id="exampleModal" tabIndex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div className="modal-dialog">
                <div className="modal-content">
                <div className="modal-header">
                    <h1 className="modal-title fs-5" id="exampleModalLabel">Nuevo Egreso</h1>
                    <button type="button" className="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form onSubmit={storeEgreso}>
                    <div className="modal-body">
                            <div className="form-group">
                            <label htmlFor="exampleInputEmail1">Monto</label>
                            <input type="number" name="monto" value={monto} onChange={(e) => setMonto(e.target.value)} className="form-control" aria-describedby="emailHelp" placeholder="Ingrese Monto" required/>
                            <small id="emailHelp" className="form-text text-muted"></small>
                            </div>
                            <div className="form-group">
                            <label htmlFor="exampleInputPassword1">Fecha</label>
                            <input type="date" name="fecha" value={fecha} onChange={(e) => setFecha(e.target.value)} className="form-control" required/>
                            </div>
                    </div>
                    <div className="modal-footer">
                        <button type="button" className="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" className="btn btn-primary">Guardar</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
  )
}
