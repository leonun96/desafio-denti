import React, {useEffect, useState} from 'react'
import axios from 'axios'
import {Link} from 'react-router-dom'



const endpoint = "http://localhost/api/ingreso";
export const IngresosComponent = () => {
    const date = new Date();
    // console.log(date, date.toLocaleDateString('en-US'), date.toISOString(), formatDate(date,'yy-mm-dd'));
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
        getAllIngresos();
    }, [])

    const [ ingresos, setIngresos ] = useState( [] )

    const getAllIngresos = async () => {
        const response = await axios.get(`${endpoint}`)
        setIngresos(response.data)
        console.log(ingresos, response.data, Object.keys(ingresos));
    }
    const deleteIngresos = async (id) => {
        await fetch(`${endpoint}/${id}/delete`, { method: 'DELETE' })
        .then(response => {
            return response.json()
        })
        .then(data => {
            console.log(data);
            // setIngresos(data)
        });
        getAllIngresos();
    }

    const storeIngreso = async (e) => {
        e.preventDefault()
        console.log("ENVIANDO...", `${endpoint}/store`)
        // await axios.post(`${endpoint}/store`, {fecha: fecha, monto: monto});
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
            // setIngresos(data)
        });
        getAllIngresos();
    }
  return (
    <div>
        <div className='d-grid gap-2'>
        <button type="button" className="btn btn-success btn-lg mt-2 mb-2 text-white" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Nuevo ingreso
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
                    (ingresos).map( (ingreso, index) => (
                        <tr key={index}>
                            <td> {ingreso.monto} </td>
                            <td> {ingreso.fecha} </td>
                            <td>
                                {/* <Link to={`/edit/${product.id}`} className='btn btn-warning'>Edit</Link> */}
                                <button onClick={ ()=>deleteIngresos(ingreso.id) } className='btn btn-danger'>Eliminar</button>
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
                    <h1 className="modal-title fs-5" id="exampleModalLabel">Nuevo Ingreso</h1>
                    <button type="button" className="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form onSubmit={storeIngreso}>
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
// export default IngresosComponent