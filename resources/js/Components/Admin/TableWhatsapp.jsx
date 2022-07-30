import { Link } from "@inertiajs/inertia-react";
import React from "react";

const TableWhatsapp = (props) => {
    return (
        <div className="overflow-scroll">
            <table className="table-auto w-full">
                <thead className="bg-gray-50 border-b-2 border-gray-200 text-black">
                    <tr>
                        <th className="p-3 text-sm font-semibold tracking-wide text-left">
                            No
                        </th>
                        <th className="w-auto p-3 text-sm font-semibold tracking-wide text-left">
                            Name
                        </th>
                        <th className="w-full p-3 text-sm font-semibold tracking-wide text-left">
                            Number
                        </th>
                        <th className="w-3 p-3 text-sm font-semibold tracking-wide text-left">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody className="bg-white">
                    {props.whatsapp.map((data, index) => {
                        return (
                            <tr
                                key={index}
                                className="border-b border-gray-200"
                            >
                                <td className="p-3 text-sm text-gray-700 text-center">
                                    {index + 1}
                                </td>
                                <td className="p-3 text-sm text-gray-700">
                                    {data.name}
                                </td>
                                <td className="p-3 text-sm text-gray-700">
                                    {data.number}
                                </td>
                                <td className="p-3 text-sm text-gray-700 bg-slate-50">
                                    <div className="flex flex-col gap-2">
                                        <Link
                                            as="button"
                                            href={route("whatsapp.edit", {
                                                id: data.id,
                                            })}
                                            method="get"
                                            className="btn btn-xs btn-success w-full rounded-md text-white font-medium"
                                        >
                                            Edit
                                        </Link>
                                        <Link
                                            as="button"
                                            href={route("whatsapp.destroy", {
                                                id: data.id,
                                            })}
                                            method="delete"
                                            className="btn btn-xs btn-error w-full rounded-md text-white font-medium transition-all duration-75"
                                        >
                                            Delete
                                        </Link>
                                    </div>
                                </td>
                            </tr>
                        );
                    })}
                </tbody>
            </table>
        </div>
    );
};

export default TableWhatsapp;
