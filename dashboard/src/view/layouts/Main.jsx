import { Row, Col, FormControl, Button, Image, Spinner, Container } from "react-bootstrap";
import Sidebar from "./Sidebar";

const Main = () => {
    return (
        <div className='d-flex flex-row flex-nowrap'>
            <div className='flex-grow-1'>
                haha
            </div>
            <div style={{ backgroundColor: "red" }}>
                <Sidebar />
            </div>
        </div>
    );
}

export default Main;
