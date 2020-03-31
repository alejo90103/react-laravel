import React from 'react';
// import Shimmer from "react-shimmer-effect";
import { makeStyles, useTheme } from '@material-ui/core/styles';
import Skeleton from '@material-ui/lab/Skeleton';

const useStyles = makeStyles((theme) => ({
  root: {
    alignItems: 'center',
  }
}));

const SkeletonLine = () => {
  const classes = useStyles();
  return (
    <div className={`row d-flex p-3 ${classes.root}`} >
      <Skeleton variant="rect" className='col-md-10 ml-2' animation="pulse" width={'100%'} height={8} />
      <Skeleton variant="circle" animation="pulse" width={40} height={40} style={{ marginLeft: "16px" }} />
      <Skeleton variant="circle" animation="pulse" width={40} height={40} style={{ marginLeft: "16px" }}/>
    </div>
  );
}

export default SkeletonLine;
