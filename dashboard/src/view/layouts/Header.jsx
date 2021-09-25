import { FaCog, FaRegBell, FaRegEnvelope, FaCalendarAlt } from "react-icons/fa";
import { BsList } from "react-icons/bs";


const Header = ({ changeStatus }) => {
    return (
        <div className='d-flex justify-content-between flex-row header'>
            <div className='d-flex flex-row'>
                <div className='header-icon'>
                    <div className='header-item-badge'>9</div>
                    <FaCog />
                </div>
                <div className='header-icon'>
                    <div className='header-item-badge'>9</div>
                    <FaRegBell />
                </div>
                <div className='header-icon'>
                    <FaRegEnvelope />
                </div>
                <div className='header-icon'>
                    <div className='header-item-badge'>9</div>
                    <FaCalendarAlt />
                </div>
            </div>
            <div className='header-icon d-sm-none'>
                <BsList onClick={() => { changeStatus() }} />
            </div>
        </div>
    );
}

export default Header;
