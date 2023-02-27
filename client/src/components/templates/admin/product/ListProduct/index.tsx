import { IAdminProduct } from "@/interfaces/Product";
import React, { ChangeEvent, MouseEvent, useState, FC } from "react";
import { filter } from "lodash";
// @mui
import Card from "@mui/material/Card";
import Table from "@mui/material/Table";
import Stack from "@mui/material/Stack";
import Paper from "@mui/material/Paper";
import Avatar from "@mui/material/Avatar";
import Button from "@mui/material/Button";
import Popover from "@mui/material/Popover";
import Checkbox from "@mui/material/Checkbox";
import TableRow from "@mui/material/TableRow";
import MenuItem from "@mui/material/MenuItem";
import TableBody from "@mui/material/TableBody";
import TableCell from "@mui/material/TableCell";
import Container from "@mui/material/Container";
import Typography from "@mui/material/Typography";
import IconButton from "@mui/material/IconButton";
import TableContainer from "@mui/material/TableContainer";
import TablePagination from "@mui/material/TablePagination";
import Box from "@mui/material/Box";
//component
import Iconify from "@/components/shared/iconify";
import Scrollbar from "@/components/shared/scrollbar";
import ListBrandHead from "./section/ListHead";
import Label from "@/components/shared/label";
import ListBrandToolbar from "./section/ListToolbar";
import USERLIST from "@/_mock/user";
import Link from "next/link";
import { sentenceCase } from "change-case";
import { LazyLoadImage } from "react-lazy-load-image-component";

const TABLE_HEAD = [
  { id: "id", label: "ID", alignRight: false },
  { id: "name", label: "Name", alighnRight: false },
  { id: "created_at", label: "Create At", alignRight: false },
  { id: "status", label: "Status", alignRight: false },
  { id: "" },
];

type OrderByType = "id" | "name" | "status";

function descendingComparator(
  a: IAdminProduct,
  b: IAdminProduct,
  orderBy: OrderByType
) {
  if (b[orderBy] < a[orderBy]) {
    return -1;
  }
  if (b[orderBy] > a[orderBy]) {
    return 1;
  }
  return 0;
}

function getComparator(order: "asc" | "desc", orderBy: OrderByType) {
  return order === "desc"
    ? (a: IAdminProduct, b: IAdminProduct) =>
        descendingComparator(a, b, orderBy)
    : (a: IAdminProduct, b: IAdminProduct) =>
        -descendingComparator(a, b, orderBy);
}

function applySortFilter(
  array: IAdminProduct[] = [],
  comparator: any,
  query: string
) {
  const stabilizedThis = array.map((el, index) => ({ el, index }));
  stabilizedThis.sort((a, b) => {
    const order = comparator(a.el, b.el);
    if (order !== 0) return order;
    return a.index - b.index;
  });
  if (query) {
    return filter(
      array,
      (_user) => _user.name.toLowerCase().indexOf(query.toLowerCase()) !== -1
    );
  }
  return stabilizedThis.map((el) => el.el);
}

interface IListProductTempalte {
  data?: IAdminProduct[];
}

const ListProductTemplate: FC<IListProductTempalte> = (props) => {
  const { data } = props;
  const [open, setOpen] = useState<any>(null);

  const [page, setPage] = useState(0);

  const [order, setOrder] = useState<"asc" | "desc">("asc");

  const [selected, setSelected] = useState<string[]>([]);

  const [orderBy, setOrderBy] = useState<OrderByType>("name");

  const [filterName, setFilterName] = useState("");

  const [rowsPerPage, setRowsPerPage] = useState(5);

  const handleOpenMenu = (event: MouseEvent<HTMLElement>) => {
    setOpen(event.currentTarget);
  };

  const handleCloseMenu = () => {
    setOpen(null);
  };

  const handleRequestSort = (event: any, property: OrderByType) => {
    const isAsc = orderBy === property && order === "asc";
    setOrder(isAsc ? "desc" : "asc");
    setOrderBy(property);
  };

  const handleSelectAllClick = (event: ChangeEvent<HTMLInputElement>) => {
    if (event.target.checked) {
      const newSelecteds = USERLIST.map((n) => n.name);
      setSelected(newSelecteds);
      return;
    }
    setSelected([]);
  };

  const handleClick = (event: ChangeEvent<HTMLInputElement>, name: string) => {
    const selectedIndex = selected.indexOf(name);
    let newSelected: string[] = [];
    if (selectedIndex === -1) {
      newSelected = newSelected.concat(selected, name);
    } else if (selectedIndex === 0) {
      newSelected = newSelected.concat(selected.slice(1));
    } else if (selectedIndex === selected.length - 1) {
      newSelected = newSelected.concat(selected.slice(0, -1));
    } else if (selectedIndex > 0) {
      newSelected = newSelected.concat(
        selected.slice(0, selectedIndex),
        selected.slice(selectedIndex + 1)
      );
    }
    setSelected(newSelected);
  };

  const handleChangePage = (
    event: MouseEvent<HTMLButtonElement> | null,
    newPage: number
  ) => {
    setPage(newPage);
  };

  const handleChangeRowsPerPage = (
    event: ChangeEvent<HTMLInputElement | HTMLTextAreaElement>
  ) => {
    setPage(0);
    setRowsPerPage(parseInt(event.target.value, 10));
  };

  const handleFilterByName = (event: ChangeEvent<HTMLInputElement>) => {
    setPage(0);
    setFilterName(event.target.value);
  };

  const emptyRows =
    page > 0 ? Math.max(0, (1 + page) * rowsPerPage - USERLIST.length) : 0;

  const filteredUsers = applySortFilter(
    data,
    getComparator(order, orderBy),
    filterName
  );

  const isNotFound = !filteredUsers.length && !!filterName;

  return (
    <>
      <Container>
        <Stack
          direction="row"
          alignItems="center"
          justifyContent="space-between"
          mb={5}
        >
          <Typography variant="h4" gutterBottom>
            List Product
          </Typography>
          <Button
            LinkComponent={Link}
            variant="contained"
            startIcon={<Iconify icon="eva:plus-fill" />}
            href="/admin/product/create"
          >
            New Product
          </Button>
        </Stack>

        <Card>
          <ListBrandToolbar
            numSelected={selected.length}
            filterName={filterName}
            onFilterName={handleFilterByName}
          />

          <Scrollbar>
            <TableContainer sx={{ minWidth: 800 }}>
              <Table>
                <ListBrandHead
                  order={order}
                  orderBy={orderBy}
                  headLabel={TABLE_HEAD}
                  rowCount={USERLIST.length}
                  numSelected={selected.length}
                  onRequestSort={handleRequestSort}
                  onSelectAllClick={handleSelectAllClick}
                />
                <TableBody>
                  {filteredUsers
                    .slice(page * rowsPerPage, page * rowsPerPage + rowsPerPage)
                    .map((row) => {
                      const {
                        id,
                        name,
                        slug,
                        status,
                        thumbnail_url,
                        created_at,
                      } = row;
                      const selectedUser = selected.indexOf(name) !== -1;

                      return (
                        <>
                          <TableRow
                            hover
                            key={id}
                            tabIndex={-1}
                            role="checkbox"
                            selected={selectedUser}
                          >
                            <TableCell padding="checkbox">
                              <Checkbox
                                checked={selectedUser}
                                onChange={(event) => handleClick(event, name)}
                              />
                            </TableCell>

                            <TableCell component="th" scope="row">
                              <Stack
                                direction="row"
                                alignItems="center"
                                spacing={2}
                              >
                                <Typography variant="subtitle2" noWrap>
                                  {id}
                                </Typography>
                              </Stack>
                            </TableCell>

                            <TableCell
                              component="th"
                              scope="row"
                              padding="none"
                            >
                              <Stack
                                direction="row"
                                alignItems="center"
                                spacing={2}
                              >
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
                              <Stack
                                direction="row"
                                alignItems="center"
                                spacing={2}
                              >
                                <Typography variant="subtitle2" noWrap>
                                  {created_at}
                                </Typography>
                              </Stack>
                            </TableCell>
                            <TableCell align="left">
                              <Label
                                color={status == false ? "error" : "success"}
                              >
                                {sentenceCase(
                                  status == true ? "active" : "unactive"
                                )}
                              </Label>
                            </TableCell>

                            <TableCell align="right">
                              <IconButton
                                size="large"
                                color="inherit"
                                onClick={handleOpenMenu}
                              >
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
                                <Iconify
                                  icon={"eva:edit-fill"}
                                  sx={{ mr: 2 }}
                                />
                                Edit
                              </MenuItem>
                            </Link>

                            <MenuItem sx={{ color: "error.main" }}>
                              <Iconify
                                icon={"eva:trash-2-outline"}
                                sx={{ mr: 2 }}
                              />
                              Delete
                            </MenuItem>
                          </Popover>
                        </>
                      );
                    })}
                  {emptyRows > 0 && (
                    <TableRow style={{ height: 53 * emptyRows }}>
                      <TableCell colSpan={6} />
                    </TableRow>
                  )}
                </TableBody>

                {isNotFound && (
                  <TableBody>
                    <TableRow>
                      <TableCell align="center" colSpan={6} sx={{ py: 3 }}>
                        <Paper
                          sx={{
                            textAlign: "center",
                          }}
                        >
                          <Typography variant="h6" paragraph>
                            Not found
                          </Typography>

                          <Typography variant="body2">
                            No results found for &nbsp;
                            <strong>&quot;{filterName}&quot;</strong>.
                            <br /> Try checking for typos or using complete
                            words.
                          </Typography>
                        </Paper>
                      </TableCell>
                    </TableRow>
                  </TableBody>
                )}
              </Table>
            </TableContainer>
          </Scrollbar>

          <TablePagination
            rowsPerPageOptions={[5, 10, 25]}
            component="div"
            count={USERLIST.length}
            rowsPerPage={rowsPerPage}
            page={page}
            onPageChange={handleChangePage}
            onRowsPerPageChange={handleChangeRowsPerPage}
          />
        </Card>
      </Container>
    </>
  );
};

export default ListProductTemplate;
