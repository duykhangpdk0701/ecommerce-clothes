import React, { FC, MouseEvent, useState } from "react";
//mui component
import TableRow from "@mui/material/TableRow";
import TableCell from "@mui/material/TableCell";
import Stack from "@mui/material/Stack";
import Typography from "@mui/material/Typography";
import Link from "next/link";
import Box from "@mui/material/Box";
import Label from "@/components/shared/label";
import IconButton from "@mui/material/IconButton";
import Popover from "@mui/material/Popover";
import MenuItem from "@mui/material/MenuItem";
//component
import Iconify from "@/components/shared/iconify";
import { LazyLoadImage } from "react-lazy-load-image-component";
import { sentenceCase } from "change-case";
import { Switch } from "@mui/material";
import { useMutation } from "react-query";
import adminItemAPI from "@/api/admin/adminItemAPI";
import { useAppDispatch } from "@/hooks/redux";
import { setSnackbar } from "@/contexts/slices/snackbarSlice";

interface IItemRowItemList {
  id: number;
  name: string;
  slug: string;
  status: boolean;
  thumbnail_url: string;
  created_at: string;
}

const ItemRowItemList: FC<IItemRowItemList> = (props) => {
  const { id, name, slug, status, thumbnail_url, created_at } = props;
  const dispatch = useAppDispatch();
  const [open, setOpen] = useState<any>(null);

  const toggleFeatureMutation = useMutation({
    mutationKey: ["item"],
    mutationFn: ({ id }: { id: number }) => adminItemAPI.toggleFeature(id),

    onSuccess: () => {
      dispatch(
        setSnackbar({
          snackbarOpen: true,
          snackbarType: "success",
          snackbarMessage: "Thay đổi Feature sản Phẩm thành công",
        })
      );
    },
    onError: () => {
      dispatch(
        setSnackbar({
          snackbarOpen: true,
          snackbarType: "error",
          snackbarMessage: "Thay đổi Feature sản phẩm không thành công",
        })
      );
    },
  });

  const toggleActiveMutation = useMutation({
    mutationKey: ["item"],
    mutationFn: ({ id }: { id: number }) => adminItemAPI.toggleStatus(id),

    onSuccess: () => {
      dispatch(
        setSnackbar({
          snackbarOpen: true,
          snackbarType: "success",
          snackbarMessage: "Thay đổi Feature sản Phẩm thành công",
        })
      );
    },
    onError: () => {
      dispatch(
        setSnackbar({
          snackbarOpen: true,
          snackbarType: "error",
          snackbarMessage: "Thay đổi Feature sản phẩm không thành công",
        })
      );
    },
  });

  const handleOpenMenu = (event: MouseEvent<HTMLElement>) => {
    setOpen(event.currentTarget);
  };

  const handleCloseMenu = () => {
    setOpen(null);
  };

  const handleOnChangeToogleFeature = () => {
    toggleFeatureMutation.mutate({ id });
  };

  const handleOnChangeToogleActive = () => {
    toggleActiveMutation.mutate({ id });
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

        <TableCell component="th" scope="row" padding="none">
          <Stack direction="row" alignItems="center" spacing={2}>
            <Box className="h-12 w-12 rounded-xl overflow-hidden">
              <LazyLoadImage
                className="h-full object-cover"
                src={thumbnail_url}
                alt="thumbnail"
              />
            </Box>
            <Link
              href={`/admin/prduct/${slug}`}
              passHref
              className="text-inherit no-underline hover:underline"
            >
              <Typography variant="subtitle2" noWrap>
                {name}
              </Typography>
            </Link>
          </Stack>
        </TableCell>

        <TableCell component="th" scope="row">
          <Stack direction="row" alignItems="center" spacing={2}>
            <Typography variant="subtitle2" noWrap>
              {created_at}
            </Typography>
          </Stack>
        </TableCell>
        <TableCell align="left">
          <Label color={status == false ? "error" : "success"}>
            {sentenceCase(status == true ? "active" : "unactive")}
          </Label>
        </TableCell>

        <TableCell align="left">
          <Switch value={status} onChange={handleOnChangeToogleFeature} />
        </TableCell>

        <TableCell align="left">
          <Switch onChange={handleOnChangeToogleActive} />
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
        <Link href={`/admin/brand/${id}/update`} passHref>
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

export default ItemRowItemList;
