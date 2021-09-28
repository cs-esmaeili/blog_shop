import { FaCog, FaRegBell, FaRegEnvelope, FaCalendarAlt } from "react-icons/fa";
import { BsList, BsBoxArrowInRight } from "react-icons/bs";
import { Dropdown } from 'react-bootstrap';
import { Calendar } from 'react-datepicker2';
import LogOutModal from "../components/LogOutModal";
import { useState } from 'react';



const Header = ({ changeStatus }) => {

    const [show, setShow] = useState(false);

    return (
        <div className='d-flex justify-content-between flex-row header'>
            <div className='d-flex flex-row'>
                <div className='header-icon'>
                    <div className='header-item-badge'>9</div>
                    <Dropdown autoClose="outside">
                        <Dropdown.Toggle id='header-dropdown' bsPrefix={{}}>
                            <FaCog />
                        </Dropdown.Toggle>
                        <Dropdown.Menu>
                            <Dropdown.Item onClick={() => setShow(true)}>
                                <span>خروج از حساب کاربری</span>
                                <BsBoxArrowInRight className='header-dropdown-icon' />
                            </Dropdown.Item>
                        </Dropdown.Menu>
                    </Dropdown>
                    <LogOutModal show={show} close={() => setShow(false)} />
                </div>
                <div className='header-icon'>
                    <div className='header-item-badge'>9</div>
                    <FaRegBell />
                </div>
                <div className='header-icon'>
                    <FaRegEnvelope />
                </div>
                <div className='header-icon'>
                    <Dropdown autoClose="outside">
                        <Dropdown.Toggle id='header-dropdown' bsPrefix={{}}>
                            <FaCalendarAlt />
                        </Dropdown.Toggle>
                        <Dropdown.Menu>
                            <Dropdown.Item>
                                <Calendar />
                            </Dropdown.Item>
                        </Dropdown.Menu>
                    </Dropdown>
                </div>
            </div>
            <div className='header-icon d-sm-none'>
                <BsList onClick={() => { changeStatus() }} />
            </div>
        </div>
    );
}

export default Header;
