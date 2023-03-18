import React from "react";

//mui component
import TableRow from "@mui/material/TableRow";
import TableCell from "@mui/material/TableCell";
import Stack from "@mui/material/Stack";
import Typography from "@mui/material/Typography";
import Box from "@mui/material/Box";
import IconButton from "@mui/material/IconButton";
import Skeleton from "@mui/material/Skeleton";

const LoadingCell = () => {
  return (
    <>
      <TableRow hover tabIndex={-1} role="checkbox">
        <TableCell component="th" scope="row">
          <Stack direction="row" alignItems="center" spacing={2}>
            <Typography variant="subtitle2" noWrap>
              <Skeleton className="w-5" />
            </Typography>
          </Stack>
        </TableCell>

        <TableCell component="th" scope="row" padding="none">
          <Stack direction="row" alignItems="center" spacing={2}>
            <Box className="h-12 w-12 rounded-xl overflow-hidden">
              <Skeleton className="w-full h-full" variant="rounded" />
            </Box>

            <Typography variant="subtitle2" noWrap>
              <Skeleton className="w-28" />
            </Typography>
          </Stack>
        </TableCell>

        <TableCell component="th" scope="row">
          <Stack direction="row" alignItems="center" spacing={2}>
            <Typography variant="subtitle2" noWrap>
              <Skeleton className="w-20" />
            </Typography>
          </Stack>
        </TableCell>
        <TableCell align="left">
          <Skeleton className="w-10" />
        </TableCell>

        <TableCell align="left">
          <Skeleton className="w-10" />
        </TableCell>

        <TableCell align="left">
          <Skeleton className="w-10" />
        </TableCell>

        <TableCell align="right">
          <IconButton size="large" color="inherit">
            <Skeleton className="w-10" />
          </IconButton>
        </TableCell>
      </TableRow>
    </>
  );
};

export default LoadingCell;
