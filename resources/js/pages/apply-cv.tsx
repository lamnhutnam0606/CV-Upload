import { usePage, useForm } from "@inertiajs/react";
import React from "react";

type TitleProp = {
    title: string;
};

export default function ApplyCV({title}: TitleProp) {
    return (
        <div className="max-w-xl mx-auto mt-10 p-6 border rounded-lg bg-black">
            <h3 className="text-xl text-center font-semibold mb-4">
            { title }
            </h3>

            <form className="space-y-4">
                <div>
                    <label className="block text-sm font-medium mb-1">
                    CV (PDF, DOC)
                    </label>
                    <input
                    type="file"
                    accept=".pdf,.doc,.docx"
                    className="w-full"
                    />
                </div>

                <button
                    type="submit"
                    className="w-full text-white py-2 rounded hover:bg-green-700"
                >
                    Nộp CV
                </button>
            </form>
        </div>
    );
}
