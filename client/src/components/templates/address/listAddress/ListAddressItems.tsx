import DeleteIcon from "@mui/icons-material/Delete";
import EditIcon from "@mui/icons-material/Edit";
import Dialog from "@mui/material/Dialog";
import DialogActions from "@mui/material/DialogActions";
import DialogTitle from "@mui/material/DialogTitle";
import DialogContent from "@mui/material/DialogContent";
import DialogContentText from "@mui/material/DialogContentText";
import IconButton from "@mui/material/IconButton";
import Paper from "@mui/material/Paper";
import Button from "@mui/material/Button";
import LoadingButton from "@mui/lab/LoadingButton";

import Link from "next/link";
import React, { FC } from "react";
import { useMutation } from "react-query";
import addressAPI from "@/api/address";
import { useAppDispatch } from "@/hooks/redux";
import { setSnackbar } from "@/contexts/slices/snackbarSlice";

interface IListAddressItems {
  id: number;
  address: string;
  addressToString: string;
  phone: string;
  name: string;
}

const ListAddressItems: FC<IListAddressItems> = (props) => {
  const { id, address, addressToString, phone, name } = props;

  const [open, setOpen] = React.useState(false);

  const dispatch = useAppDispatch();

  const deleteAddressMutation = useMutation({
    mutationKey: ["addresss"],
    mutationFn: (id: number) => addressAPI.deleteAddressById(id),
    onSuccess: () => {
      dispatch(
        setSnackbar({
          snackbarOpen: true,
          snackbarType: "success",
          snackbarMessage: "Delete Address successfully",
        })
      );
    },
    onError: (error: any) => {
      dispatch(
        setSnackbar({
          snackbarOpen: true,
          snackbarType: "error",
          snackbarMessage: error.message,
        })
      );
    },
  });

  const handleRemoveAddress = async () => {
    await deleteAddressMutation.mutateAsync(id);
    setOpen(false);
  };

  const handleClickOpen = async () => {
    setOpen(true);
  };

  const handleClose = () => {
    setOpen(false);
  };

  return (
    <>
      <Paper className="my-4 py-1.5 px-4 flex items-center">
        <Link
          href={`address/${id}`}
          className="no-underline flex flex-1"
          passHref
        >
          <p className="flex-1">{name}</p>
          <p className="flex-[1_1_260px] pr-10 whitespace-nowrap text-ellipsis overflow-hidden">
            {address}, {addressToString}
          </p>
          <p className="flex-1">{phone}</p>
        </Link>
        <p>
          <IconButton LinkComponent={Link} href={`/address/${id}/update`}>
            <EditIcon className="text-xl" />
          </IconButton>
          <IconButton onClick={handleClickOpen}>
            <DeleteIcon className="text-xl" />
          </IconButton>
        </p>
      </Paper>

      <Dialog
        open={open}
        onClose={handleClose}
        aria-labelledby="alert-dialog-title"
        aria-describedby="alert-dialog-description"
      >
        <DialogTitle id="alert-dialog-title">
          Are you sure to delete this address?
        </DialogTitle>
        <DialogContent>
          <DialogContentText id="alert-dialog-description">
            Once you Delete this Address, there is no way to undo this Action!
          </DialogContentText>
        </DialogContent>
        <DialogActions>
          <Button onClick={handleClose}>cancel</Button>
          <LoadingButton
            variant="contained"
            color="error"
            onClick={handleRemoveAddress}
            autoFocus
            loading={deleteAddressMutation.isLoading}
          >
            Agree
          </LoadingButton>
        </DialogActions>
      </Dialog>
    </>
  );
};

export default ListAddressItems;
