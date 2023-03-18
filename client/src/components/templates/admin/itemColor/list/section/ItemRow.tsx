import React, { FC, MouseEvent, useState } from "react";
//mui component
import TableRow from "@mui/material/TableRow";
import TableCell from "@mui/material/TableCell";
import Stack from "@mui/material/Stack";
import Typography from "@mui/material/Typography";
import Link from "next/link";
import Label from "@/components/shared/label";
import IconButton from "@mui/material/IconButton";
import Popover from "@mui/material/Popover";
import MenuItem from "@mui/material/MenuItem";
import Box from "@mui/material/Box";
//component
import Iconify from "@/components/shared/iconify";
import { sentenceCase } from "change-case";

interface IItemColorRow {
  id: number;
  name: string;
  status: boolean;
  value: string;
}

const ItemListBrand: FC<IItemColorRow> = (props) => {
  const { id, name, status, value } = props;

  const [open, setOpen] = useState<any>(null);

  const handleOpenMenu = (event: MouseEvent<HTMLElement>) => {
    setOpen(event.currentTarget);
  };

  const handleCloseMenu = () => {
    setOpen(null);
  };

  return (
    <>
      <TableRow hover key={id} tabIndex={-1} role="checkbox">
        <TableCell component="th" scope="row">
          <Stack direction="row" alignItems="center" spacing={2}>
            <Typography variant="subtitle2" noWrap>
              {id}
            </Typography>
          </Stack>
        </TableCell>

        <TableCell component="th" scope="row">
          <Stack direction="row" alignItems="center" spacing={2}>
            <Typography variant="subtitle2" noWrap>
              {name}
            </Typography>
          </Stack>
        </TableCell>

        <TableCell component="th" scope="row" padding="none">
          <Stack direction="row" alignItems="center" spacing={1}>
            <Box
              className="border h-7 w-7 border-solid rounded border-gray-300"
              sx={{ bgcolor: value }}
            ></Box>
            <Typography variant="subtitle2" noWrap>
              {value}
            </Typography>
          </Stack>
        </TableCell>

        <TableCell align="left">
          <Label color={status === false ? "error" : "success"}>
            {sentenceCase(status == true ? "active" : "unactive")}
          </Label>
        </TableCell>

        <TableCell align="right">
          <IconButton size="large" color="inherit" onClick={handleOpenMenu}>
            <Iconify icon={"eva:more-vertical-fill"} />
          </IconButton>
        </TableCell>
      </TableRow>
      <Popover
        open={Boolean(open)}
        anchorEl={open}
        onClose={handleCloseMenu}
        anchorOrigin={{
          vertical: "top",
          horizontal: "left",
        }}
        transformOrigin={{
          vertical: "top",
          horizontal: "right",
        }}
        PaperProps={{
          sx: {
            p: 1,
            width: 140,
            "& .MuiMenuItem-root": {
              px: 1,
              typography: "body2",
              borderRadius: 0.75,
            },
          },
        }}
      >
        <Link
          href={`/admin/item-color/${id}/update`}
          passHref
          className="no-underline text-black"
        >
          <MenuItem>
            <Iconify icon={"eva:edit-fill"} sx={{ mr: 2 }} />
            Edit
          </MenuItem>
        </Link>

        <MenuItem sx={{ color: "error.main" }}>
          <Iconify icon={"eva:trash-2-outline"} sx={{ mr: 2 }} />
          Delete
        </MenuItem>
      </Popover>
    </>
  );
};

export default ItemListBrand;
