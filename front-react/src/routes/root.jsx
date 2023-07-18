import { Outlet, Link } from "react-router-dom";

export default function Root() {
  return (
    <>
      <div id="sidebar">
      <h1>Sistema</h1>
        <div>
        <h3><Link to={`/`}>Dashboard</Link></h3>
          {/* <form method="post">
            <button type="submit">New</button>
          </form> */}
        </div>

        <nav>
          <ul>
            <li>
              <Link to={`ingresos`}>Ingresos</Link>
            </li>
            <li>
              <Link to={`egresos`}>Egresos</Link>
            </li>
          </ul>
        </nav>

        {/* other elements */}
      </div>
      <div id="detail">
        <Outlet/>
      </div>
    </>
  );
}